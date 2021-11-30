<div class="container-fluid">
  <div class="col-12">
    <nav class="navbar navbar-expand-lg navbar-light">
      <%= link_to root_path, class:"navbar-brand" do %>
        <%= image_tag asset_path("bookmarks.png"),:height => '60'); 
      <% end %>
      <button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <%= form_with url: books_path, method: :get, local: true, class:"form-inline my-2 my-lg-0" do |f| %>
          <%= f.text_field :keyword, required: true, class:"form-control mr-sm-2" %>
          <%= f.submit "検索", class:"btn btn-sm btn-secondary m-0 ml-sm-0" %>
        <% end %>
        <ul class="navbar-nav ml-auto">
          <% if user_signed_in?%>
            <li class="nav-item active mr-3">
              <%= link_to "本を探す", books_path(keyword: "本", page: rand(1..100, class:"nav-link header_find_book px-3" %>
            </li>
            <li class="nav-item active mr-4">
              <%= link_to user_path(current_user.id), class:"nav-link" do %>
                <i class="fas fa-user fa-fw"></i>
                <span>マイページ</span>
            </li>
            <li class="nav-item active mr-3">
              <%= link_to timelines_path, class:"nav-link" do %>
                <i class="fa fa-tasks"></i>
                <span>タイムライン</span>
            <li class="nav-item active mr-3">
              <%= link_to book_ranking_path(genre: "", sort: "sales"), class:"nav-link" do %>
                <i class="fas fa-crown fa-fw"></i>
                <span>ランキング</span>
            <li class="nav-item active mr-3">
              <%= link_to user_calender_path(current_user.id), class:"nav-link" do %>
              <i class="far fa-calendar-alt fa-fw"></i>
              <span>発売カレンダー</span>
            <li class="nav-item active mr-2">
              <%= render "notifications/uncheck" %>
            </li>
            <li class="nav-item active dropdown dropleft">
              <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="navbarDropdownMenuLink" role="button">
                <i class="fas fa-user fa-fw">
                </i>
              </a>
              <div aria-labelledby="navbarDropdownMenuLink m-5" class="dropdown-menu shadow">
                <%= link_to user_path(current_user), class:"dropdown-item text-secondary" do %>
                  <i class="fas fa-user fa-fw"></i>
                  <span>マイページ</span>
                = link_to edit_user_path(current_user), class:"dropdown-item text-secondary" do
                  <i class="fas fa-cog fa-fw"></i>
                  <span>プロフィール編集</span>
                = link_to root_path, class:"dropdown-item text-secondary" do
                  <i class="fas fa-book-reader fa-fw"></i>
                  <span>About</span>
                = link_to destroy_user_session_path, method: :delete, class:"dropdown-item text-secondary" do
                  <i class="fas fa-sign-out-alt fa-fw"></i>
                  <span>ログアウト</span>
              </div>
            </li>
          <% else %>
            <li class="nav-item active mr-4">
              = link_to "本を探す", books_path(keyword: "本", page: rand(1..100)), class:"header_find_book p-3"
            </li>
            <li class="nav-item active mr-4">
              = link_to root_path, class:"text-secondary" do
                <i class="fas fa-book-reader fa-fw"></i>
                <span>About</span>
            </li>
            <li class="nav-item active mr-4"></li>
              = link_to book_ranking_path(genre: "", sort: "sales"), class:"text-secondary" do
                <i class="fas fa-crown fa-fw"></i>
                <span>ランキング</span>
            </li>
            <li class="nav-item active mr-4">
              = link_to new_user_session_path, class:"text-secondary" do
                <i class="fas fa-user fa-fw"></i>
                <span>ログイン</span>
            </li>
            <li class="nav-item active mr-4">
              = link_to new_user_registration_path, class:"text-secondary" do
                <i class=" fas fa-sign-out-alt fa-fw"></i>
                <span>新規登録</span>
            </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
