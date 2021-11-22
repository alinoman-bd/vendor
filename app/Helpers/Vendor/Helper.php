<?php

namespace App\Helpers\Vendor;

use Cookie;
use Imager;
use App\Lake;
use App\River;
use App\Resource;
use WebPConvert\WebPConvert;
use App\Entertainment;
use DateTime;

class Helper
{
    public static function mainUrl()
    {
        return route('vendors.all').'/';
    }
    public static function cityUrl($city, $items = null)
    {
        $url = Helper::mainUrl();
        if(@$items['type']->slug){
            $url .= @$items['type']->slug.'/';
        }
        $url .= $city.'/';
        return $url;
    }
    public static function locationUrl($items)
    {
        $url = Helper::mainUrl();
        if(@$items['type']->slug){
            $url .= @$items['type']->slug.'/';
        }
        $url .= @$items['location']->slug.'/';
        return $url;
    }
    public static function locationLake($items)
    {
        $url = Helper::mainUrl();
        if(@$items['type']->slug){
            $url .= @$items['type']->slug.'/';
        }
        $url .= @$items['lake']->slug.'/';

        if(@$items['type']->slug == ''){
            $lake = Lake::where('slug',@$items['lake']->slug)->with('location')->first();
            if($lake){
                $url .= $lake->location->slug.'/';
            }

        }
        return $url;
    }

    public static function locationRiver($items)
    {
        $url = Helper::mainUrl();
        if(@$items['type']->slug){
            $url .= @$items['type']->slug.'/';
        }
        $url .= @$items['river']->slug.'/';

        if(@$items['type']->slug == ''){
            $river = River::where('slug',@$items['river']->slug)->with('location')->first();
            if($river){
                $url .= $river->location->slug.'/';
            }

        }
        return $url;
    }
    public static function dayLeft($start, $end)
    {
        $datetime1 = new DateTime($start);
        $datetime2 = new DateTime($end);
        $interval = $datetime1->diff($datetime2);
        return $days = $interval->format('%a');//now do whatever you like with $days
    }

    public static function entSeoMeta($items)
    {
        $title = '';
        $keyword = '';
        $description = '';
        $tag1 = '';
        $page_des = '';
        if(@$items['ent_type']){
            $title = @$items['ent_type']->seo_title.' ';
            $keyword = @$items['ent_type']->seo_keyword.',';
            $description = @$items['ent_type']->seo_description.' ';
            $tag1 = @$items['ent_type']->seo_tag.' ';
            $page_des = @$items['ent_type']->page_description.' ';
        }else{
            $title = @$items['ent_cat']->seo_title.' ';
            $keyword = @$items['ent_cat']->seo_keyword.',';
            $description = @$items['ent_cat']->seo_description.' ';
            $tag1 = @$items['ent_cat']->seo_tag.' ';
            $page_des = @$items['ent_cat']->page_description.' ';
        }

        if(@$items['ent_exist_location']){
            $title .= @$items['ent_exist_location']->seo_title;
            $keyword .= @$items['ent_exist_location']->seo_keyword;
            $description .= @$items['ent_exist_location']->seo_description;
            $tag1 .= @$items['ent_exist_location']->seo_tag;
            $page_des .= @$items['ent_exist_location']->page_description;
        }
        $meta['title'] = $title;
        $meta['keyword'] = $keyword;
        $meta['description'] = $description;
        $meta['tag1'] = $tag1;
        $meta['page_des'] = $page_des;
        return $meta;

    }
    public static function checkFavorite($status, $rec_id)
    {
        $name = ($status == 1) ? 'favorite' : 'ent_favorite';
        if (Cookie::has($name)) {
            $favorite = Cookie::get($name);
            $favorite = json_decode($favorite, true);
            if (!in_array($rec_id, $favorite)) {
                return 'add-to-my-fav';
            }else{
                return 'add-fav-color remove-from-fav';
            }
        }else{
            return 'add-to-my-fav';
        }
    }

    public static function getRating($comments)
    {
        $star  = 0.00;
        $total = count($comments);
        $number = 0;
        if(count($comments) > 0){
            foreach ($comments as $comment) {
                $number = $number + $comment->star;
            }
        }
        if($number > 0){
            $number = $number;
            $star = $number / $total;
        }
        return $star;
    }
    public static function phoneModify($phone)
    {
        return $phone;
        $new_phone = substr($phone, 0, -3);
        return $new_phone.'XXX';
    }

    public static function entVip($limit, $pkg_id)
    {
        return Entertainment::where('is_active', 1)
            ->where('package_id', $pkg_id)
            ->inRandomOrder()
            ->take($limit)
            ->get();
    }


    public static function removeAllImage($image_name, $type)
    {
        $link = '';
        if($type == 'resource'){
            $link = public_path('images/resource/');
        }else{
            $link = public_path('images/rooms/');
        }
        $large = $link.'large/'.$image_name;
        $medium = $link.'medium/'.$image_name;
        $ex_medium = $link.'ex-medium/'.$image_name;
        $small = $link.'small/'.$image_name;
        $ex_small = $link.'ex-small/'.$image_name;
        unlink($large);
        unlink($medium);
        unlink($ex_medium);
        unlink($small);
        unlink($ex_small);
    }

	public static function resourceName( $name )
	{
		return preg_replace('!\s+!', '-', $name);
	}

    public static function name( $name )
    {
        return preg_replace('!\s+!', '-', $name);
    }

	public static function resourceType($resource)
	{
		$types = [];
		if(count($resource->types) > 0){
			foreach ($resource->types as $key => $type) {
				$types[] = $type->id;
			}
		}
		return $types;
	}

    public static function entTypeList($resource)
    {
        $list = [];
        if($resource){
            foreach ($resource->EntTypes as  $ent_type) {
                $list[] = $ent_type->id;
            }
        }
        return $list;
    }
	public static function getViewed()
	{
		$rec_viewed = Cookie::get('rec_viewed');
        $flag = 1;
        if($rec_viewed){
            $rec_viewed = json_decode($rec_viewed,true);
            $resources = Resource::whereIn('id', $rec_viewed)->orderByRaw("field(id,".implode(',',$rec_viewed).")")->get();
            $flag++;
        }
        $ent_rec_viewed = Cookie::get('ent_rec_viewed');
        if($ent_rec_viewed){
            $ent_rec_viewed = json_decode($ent_rec_viewed,true);
            $entertainments = Entertainment::whereIn('id', $ent_rec_viewed)->orderByRaw("field(id,".implode(',',$ent_rec_viewed).")")->get();
            $flag++;
        }
        if($flag == 2){
            return $resources;
        }else if($flag == 3){
            $merged = $resources->merge($entertainments);
            return $result = $merged->all();
        }
        return @$resources;

	}
	public static function facilities($resource)
	{
		$facilities = [];
		if(count($resource->facilities) > 0){
			foreach ($resource->facilities as $key => $facility) {
				$facilities[] = $facility->id;
			}
		}
		return $facilities;
	}
	public static function getVip1( $limit )
    {
    	return Resource::where('is_active', 1)->where('package_id', 1)->inRandomOrder()->take($limit)->get();
    }

    public static function getVip2( $limit )
    {
    	return Resource::where('is_active', 1)->where('package_id', 2)->inRandomOrder()->take($limit)->get();
    }
    public static function sameLocationVip($resource, $limit, $pkg_id)
    {
    	$city_id = $resource->city_id;
        $location_id = $resource->location_id;
        $lake_id = $resource->lake_id;
        $rive_id = $resource->river_id;
        $sea_id = $resource->sea_id;

        $data = Resource::
            when($city_id != null, function ($q) use ($city_id) {
                return $q->where('city_id', $city_id);
            })
            ->when($location_id != null, function ($q) use ($location_id) {
                return $q->where('location_id', $location_id);
            })
            ->when($lake_id != null, function ($q) use ($lake_id) {
                return $q->where('lake_id', $lake_id);
            })
            ->when($rive_id != null, function ($q) use ($rive_id) {
                return $q->where('river_id', $rive_id);
            })
            ->when($sea_id != null, function ($q) use ($sea_id) {
                return $q->where('sea_id', $sea_id);
            })
            ->whereNotIn('id',[$resource->id])
            ->where('is_active', 1)
            ->where('package_id', $pkg_id)
            ->inRandomOrder()
            ->take($limit)
            ->get();
        return $data;
    }

    public static function seoMeta($items)
    {
        if($items){
            $meta = [];
            $title = '';
            $keyword = '';
            $description = '';
            $tag1 = '';
            $page_des = '';
            if(@$items['type']){
                $title .= @$items['type']->seo_title.' ';
                $keyword .= @$items['type']->seo_keyword.',';
                $description .= @$items['type']->seo_description.' ';
                $tag1 .= @$items['type']->seo_tag.' ';
                $page_des .= @$items['type']->page_description.' ';
            }
            if(@$items['river']){
                $title .= @$items['river']->seo_title.' ';
                $keyword .= @$items['river']->seo_keyword.',';
                $description .= @$items['river']->seo_description.' ';
                $tag1 .= @$items['river']->seo_tag.' ';
                $page_des .= @$items['river']->page_description.' ';
            }
            if(@$items['lake']){
                $title .= @$items['lake']->seo_title.' ';
                $keyword .= @$items['lake']->seo_keyword.',';
                $description .= @$items['lake']->seo_description.' ';
                $tag1 .= @$items['lake']->seo_tag.' ';
                $page_des .= @$items['lake']->page_description.' ';
            }
            if(@$items['sea']){
                $title .= @$items['sea']->seo_title.' ';
                $keyword .= @$items['sea']->seo_keyword.',';
                $description .= @$items['sea']->seo_description.' ';
                $tag1 .= @$items['sea']->seo_tag.' ';
                $page_des .= @$items['sea']->page_description.' ';
            }

            if(@$items['location']){
                $title .= @$items['location']->seo_title.' ';
                $keyword .= @$items['location']->seo_keyword.',';
                $description .= @$items['location']->seo_description.' ';
                $tag1 .= @$items['location']->seo_tag.' ';
                $page_des .= @$items['location']->page_description.' ';
            }
            if(@$items['city']){
                $title .= @$items['city']->seo_title.' ';
                $keyword .= @$items['city']->seo_keyword.',';
                $description .= @$items['city']->seo_description.' ';
                $tag1 .= @$items['city']->seo_tag.' ';
                $page_des .= @$items['city']->page_description.' ';
            }
            $meta['title'] = trim($title);
            $meta['keyword'] = trim($keyword);
            $meta['description'] = trim($description);
            $meta['tag1'] = trim($tag1);
            $meta['page_des'] = trim($page_des);
            return $meta;
        }
    }


    public static function resizeAndConpress($file, $width, $height, $ratio, $path)
    {
        $imager = new \Imager($file);
        $imager->resize($width / $ratio,$height / $ratio)->write($path);
    }

    public static function imageSavePath($ratio, $type)
    {
        $destination_path = '';
        if($type == 'resource'){
           $destination_path = public_path('images/resource/');
        }else{
            $destination_path = public_path('images/rooms/');
        }
        if($ratio == 1){
            $image_name = time().'-'.$type.'-large.webp';
            $destination_path .= 'large/'.$image_name;
        }elseif($ratio == 1.5){
            $image_name = time().'-'.$type.'-medium.webp';
            $destination_path .= 'medium/'.$image_name;
        }elseif($ratio == 2){
            $image_name = time().'-'.$type.'-ex-medium.webp';
            $destination_path .= 'ex-medium/'.$image_name;
        }elseif($ratio == 3){
            $image_name = time().'-'.$type.'-small.webp';
            $destination_path .= 'small/'.$image_name;
        }elseif($ratio == 3.5){
            $image_name = time().'-'.$type.'-ex-small.webp';
            $destination_path .= 'ex-small/'.$image_name;
        }
        $data['path'] = $destination_path;
        $data['name'] = $image_name;
        return $data;
    }

    public static function removeImage($img_path)
    {
        unlink($img_path);
    }
    public static function phpImageCompressToWebp($upload_path, $image_name,$jpg)
    {
        $file = public_path($upload_path.$image_name.$jpg);
        $image = imagecreatefromstring(file_get_contents($file));
        ob_start();
        imagejpeg($image,NULL,0.1);
        $cont = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        $content = imagecreatefromstring($cont);
        $output = public_path($upload_path.$image_name.'.webp');
        imagewebp($content,$output);
        imagedestroy($content);
    }

    public static function laravelImageToWebp($source, $destination){
        WebPConvert::serveConverted($source, $destination, [
            'fail' => 'original',
            'fail-when-fail-fails' => 'throw',
            'reconvert' => false,
            'serve-original' => false,
            'show-report' => false,
            'suppress-warnings' => true,
            'serve-image' => [
                'headers' => [
                    'cache-control' => true,
                    'content-length' => true,
                    'content-type' => true,
                    'expires' => false,
                    'last-modified' => true,
                    'vary-accept' => false
                ],
                'cache-control-header' => 'public, max-age=31536000',
            ],
            'redirect-to-self-instead-of-serving' => true,
            'convert' => [
                'quality' => 'auto',
            ]
        ]);
    }




}
