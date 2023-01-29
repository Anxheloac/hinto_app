@foreach($users as $user)

    {{ __('emails.posts_mail.has_writen_p', ['user' => $user->name]) }} <br/>

    @include('emails.partials.posts_list', ['posts' => $user->posts])

@endforeach
