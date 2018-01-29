<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Email: ylsc633@gmail.com
 * Date: 2017/6/7
 * Time: 上午10:43
 */

namespace App\Transformers;


use App\Models\Posts;

class PostListTransformer extends BaseTransformer
{
    public function transform(Posts $posts)
    {
        $return = [
//            'id' => $posts->id,
            'hid' => $posts->hid,
            'title' => $posts->title,
            'content' => $posts->content,
            'source' => $posts->source,
//            'user_id' => $posts->user_id,
            'replyCount' => $posts->reply_count,
            'viewCount' => $posts->view_count,
            'voteCount' => $posts->vote_count,
//            'last_reply_user_id' => $posts->last_reply_user_id,
//            'order' => $posts->order,
            'isTop' => $posts->is_top,
//            'isExcellent' => $posts->is_excellent,
//            'isBlocked' => $posts->is_blocked,
            'bodyOriginal' => $posts->body_original,
//            'excerpt' => $posts->excerpt,
//            'isTagged' => $posts->is_tagged,
            'createdAt' => rfc_3339($posts->created_at),
            'created' => $posts->created_at->diffForHumans(),
        ];
        if ($posts->user_hid) {
            $return['user'] = [
                'hid' => $posts->author->hid,
                'name' => $posts->author->name,
                'avatar' => $posts->author->avatar,
            ];
        }

        if ($posts->last_reply_user_hid) {
            $return['lastReplyUser'] = [
                'hid' => $posts->last_reply_user->hid,
                'name' => $posts->last_reply_user->name,
                'avatar' => $posts->last_reply_user->avatar,
            ];
        }
        if ($posts->tag) {
            foreach ($posts->tag as $item) {
                $return['tag'][] = [
                    'hid' => $item->hid,
                    'name' => $item->name,
                    'displayName' => $item->display_name,
                    'description' => $item->description,
//                    'post_count' => $item->post_count,
                    'weight' => $item->weight,
                ];
            }
        }

        if ($posts->node) {
            $return['node'] = [
                'hid' => $posts->node->hid,
                'name' => $posts->node->name,
                'displayName' => $posts->node->display_name,
                'description' => $posts->node->description,
            ];
        }

        return $return;
    }
}