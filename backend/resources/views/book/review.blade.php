<div class="row">
  <div class="col-md-12">
    <div class="bg-light text-center py-3 mt-3">
      <h3>{{ count($book -> reads)}}件のレビュー </h3>
    </div>      
  </div>
</div>

<div class="row">
  @foreach $book -> reads as $review
    <div class="col-md-6">
      <div class="bg-white my-3 p-3">
        <div class="d-flex flex-row">
          <div class="flex-column">
            <div class="d-flex flex-row mb-1">
              <a href="{{ route("user.show",["user" => $review -> user]) }}">
                <img src="{{asset('images/'.$user->image)}}" class="rounded-circle" width="50px" height="50px">
              </a>
              <strong class="flex-column ml-3">
                <a href="" class="text-dark">{{ $review -> user -> name}}の感想・レビュー</a>  
                <!-- <small class="text-muted">
                  = time_ago_in_words(review.created_at).upcase
                </small> -->
              </strong>
            </div>
            <div class="ml-1">
              <div id="rate_.{{review->id}}" class="my-1"></div>

              <div class="mt-1 mr-3">
                <!-- = simple_format(review.comment.truncate(50))
                - if review.comment.size > 50
                  .small = link_to "続きを読む", book_book_read_path(review.book_id, review.id, user: review.user) -->
                <p>{{ $review -> comment }}</p>
              </div>
              <div class="mt-2">
                <!-- - if review.tag_list.present?
                  br
                  i.fas.fa-tags
                  - review.tag_counts_on(:tags).limit(5).each do |tag|
                    = link_to "##{tag.name}(#{BookRead.tags_count(tag.name)})", tag_path(tag.name), class:"badge badge-pill badge-light p-2 mt-3 mx-2"
                  - if review.tag_list.count > 5
                    span
                      = link_to "....", book_book_read_path(review.book_id, review, user: review.user), class:"text-secondary" -->
              </div>
            </div>
          </div>
        </div>

        <!-- hr
        .d-flex.flex-row
          span id="favorite_btn_#{review.id}"
            = render "read_favorites/favorite_btn", review: review

          .badge.badge-pill.badge-light.pt-2
            h6
              = link_to book_book_read_path(review.book_id, review, user: review.user), class:"comment_btn text-secondary" do
                i.fa.fa-comments コメント#{review.read_comments.count} -->
      </div>
    </div>
</div>

<script>
  $("#rate_#{review.id}").empty();
  $("#rate_#{review.id}").raty({
    size: 10,
    starOff: "#{asset_path('star-off.png')}",
    starOn: "#{asset_path('star-on.png')}",
    starHalf: "#{asset_path('star-half.png')}",
    half: true,
    readOnly: true,
    score: "#{review.rate}",
  });
</script>