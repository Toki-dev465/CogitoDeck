<?php

test('guests are redirected to login when accessing the dashboard', function () {
    $response = $this->get('/');

    $response->assertRedirect('/login');
});
