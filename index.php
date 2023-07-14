<?php

// Сделать методы для получения пользователей, их постов и заданий
// Добавить методы работы с конкретным постом (добавление / редактирование / удаление)

class API
{
    private $baseUrl = "https://jsonplaceholder.typicode.com";

    // Получение пользователей
    public function getUsers()
    {
        $url = $this->baseUrl . "/users";
        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    // Получение постов пользователя
    public function getUserPosts($userId)
    {
        $url = $this->baseUrl . "/posts?userId=" . $userId;
        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    // Получение заданий пользователя
    public function getUserTodos($userId)
    {
        $url = $this->baseUrl . "/todos?userId=" . $userId;
        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    // Получение поста
    public function getPost($postId)
    {
        $url = $this->baseUrl . "/posts/" . $postId;
        $response = file_get_contents($url);

        return json_decode($response, true);
    }

    // Добавление поста
    public function addPost($userId, $title, $body)
    {
        $url = $this->baseUrl . "/posts";

        $data = array(
            'userId' => $userId,
            'title' => $title,
            'body' => $body
        );

        $params = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );

        $context  = stream_context_create($params);
        $response = file_get_contents($url, false, $context);

        return json_decode($response, true);
    }

    // Редактирование поста
    public function updatePost($postId, $title, $body)
    {
        $url = $this->baseUrl . "/posts/" . $postId;

        $data = array(
            'title' => $title,
            'body' => $body
        );

        $params = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'PUT',
                'content' => http_build_query($data),
            )
        );

        $context  = stream_context_create($params);
        $response = file_get_contents($url, false, $context);

        return json_decode($response, true);
    }

    // Удаление поста
    public function deletePost($postId)
    {
        $url = $this->baseUrl . "/posts/" . $postId;

        $params = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'DELETE',
            )
        );

        $context  = stream_context_create($params);
        $response = file_get_contents($url, false, $context);

        return json_decode($response, true);
    }
}

// Примеры вызовов класса
$api = new API();

// Получение пользователей
$users = $api->getUsers();
var_dump($users);

// Получение постов пользователя с id 1
$userPosts = $api->getUserPosts(1);
var_dump($userPosts);

// Получение заданий пользователя с id 1
$userTodos = $api->getUserTodos(1);
var_dump($userTodos);

// Получение поста с id 1
$post = $api->getPost(1);
var_dump($post);

// Добавление нового поста
$newPost = $api->addPost(1, 'New Post', 'This is a new post');
var_dump($newPost);

// Редактирование поста с id 1
$updatedPost = $api->updatePost(1, 'Updated Post', 'This is an updated post');
var_dump($updatedPost);

// Удаление поста с id 1
$deletedPost = $api->deletePost(1);
var_dump($deletedPost);
