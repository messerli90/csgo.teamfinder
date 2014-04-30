@extends('layouts.master')
@section('content')
<h5>CSGOTeamFinder uses <a href="http://parsedown.org">Parsedown</a>, an easy to use Markdown parser.</h5>
<div class="row">
  <div class="col-md-6">
    <table class="table">
      <thead>
        <tr>
          <td><strong>You type...</strong></td>
          <td><strong>You see...</strong></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Return twice <br><br>For a new paragraph</td>
          <td><p>Return twice</p><p>For a new paragraph</p></td>
        </tr>
        <tr>
          <td>*italics*</td>
          <td><i>italics</i></td>
        </tr>
        <tr>
          <td>**bold**</td>
          <td><b>bold</b></td>
        </tr>
        <tr>
          <td>[Link](http://CSGOTeamFinder.com)</td>
          <td><a href="http://CSGOTeamFinder.com">Link</a></td>
        </tr>
        <tr>
          <td>
            - item 1 <br>
            - item 2 <br>
            - item 3
          </td>
          <td>
            <ul>
              <li>item 1</li>
              <li>item 2</li>
              <li>item 3</li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>&gt; quoted text</td>
          <td><blockquote>quoted text</blockquote></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

@stop