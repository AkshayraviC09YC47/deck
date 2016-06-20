<div id="board-status" ng-if="statusservice.active">
    <div id="emptycontent">
        <div class="icon-{{ statusservice.icon }}"></div>
        <h2>{{ statusservice.title }}</h2>
        <p>{{ statusservice.text }}</p></div>
</div>
<div id="board" class="scroll-container" >
    <h1>
        {{ boardservice.data[id].title }}
    </h1>
    <div id="board-actions">

        <div><i class="fa fa-filter"> </i> Filter</div>
        <div class="filter">by label <i class="fa  fa-caret-down"> </i>
            <ul class="filter-select bubble">
                <li ng-repeat="label in boardservice.data[id].labels"><span style="background-color:#{{ label.color }};"> </span> {{ label.title }}</li>
            </ul>
        </div>
        <div class="filter">by creator <i class="fa  fa-caret-down"> </i></div>
        <div class="filter">by members <i class="fa  fa-caret-down"> </i></div>

        <div><i class="fa fa-share-alt"> </i></div>
        <div><i class="fa fa-users"> </i></div>
        <div><i class="fa fa-ellipsis-h"> </i></div>

        </div>


    <div id="innerBoard" data-ng-model="stacks">
    <div class="stack" ng-repeat="s in stackservice.data" data-columnindex="{{$index}}" id="column{{$index}}" data-ng-model="stackservice.data"  style="border: 5px solid #{{ boardservice.getCurrent().color }};">
      <h2><span ng-show="!s.status.editStack">{{ s.title }}</span>
          <form ng-submit="stackservice.update(s)">
          <input type="text" placeholder="Add a new stack" ng-blur="s.status.editStack=false" ng-model="s.title" ng-if="s.status.editStack" autofocus-on-insert required />
          <button class="icon icon-save" ng-if="s.status.editStack" type="submit"></button>
          </form>
          <div class="stack-actions">
             <button class="icon-rename" ng-click="s.status.editStack=true"></button>
              <button class="icon-delete" ng-click="stackservice.delete(s.id)"></button>
          </div>
      </h2>
        <ul data-as-sortable="sortOptions" data-ng-model="s.cards"  style="min-height: 40px;">
      <li class="card as-sortable-item" ng-repeat="c in s.cards" data-as-sortable-item  ui-sref="board.card({boardId: id, cardId: c.id})">
          <div data-as-sortable-item-handle>
        <div class="card-upper">
			<h3>{{ c.title }}</h3>
            <ul class="labels">
                <li ng-repeat="label in c.labels" style="background-color: #{{ label.color }};"><span>{{ label.title }}</span></li>
            </ul>

        </div>
			  <button class="card-options icon-more" ng-click="c.status.showMenu=!c.status.showMenu; $event.stopPropagation();" ng-model="card"></button>
			  <div class="popovermenu bubble" ng-show="c.status.showMenu"><ul>
					  <li><a class="menuitem action action-rename permanent" data-action="Rename"><span class="icon icon-rename"></span><span>Umbenennen</span></a></li>
					  <li><a class="menuitem action action-rename permanent" data-action="Rename"><span class="icon icon-rename"></span><span>Archive</span></a></li>
					  <li><a class="menuitem action action-delete permanent" data-action="Delete" ng-click="cardDelete(c)"><span class="icon icon-delete"></span><span>Löschen</span></a></li></ul>
			  </div>
		<div class="card-assignees">
            <!--   <div class="avatar" avatar user="{{c.owner}}" size="24"></div>//-->
			</div>
        <!--<span class="info due"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Today</span></span>
        <span class="info tasks"><i class="fa fa-list" aria-hidden="true"></i> <span>3/12</span></span>
        <span class="info members"><i class="fa fa-users" aria-hidden="true"></i> <span>4</span></span>
		//-->


          </div>
      </li>
      </ul>
        <!-- CREATE CARD //-->
      <div class="card create" style="background-color:#{{ boardservice.getCurrent().color }};">
          <form ng-submit="createCard(s.id, newCard.title)">
            <h3 ng-if="s.status.addCard" >
                <input type="text" autofocus-on-insert ng-model="newCard.title" ng-blur="s.status.addCard=false" required />
            </h3>
          </form>
        <div class="fa fa-plus" ng-if="!s.status.addCard" ng-click="s.status.addCard=!s.status.addCard"></div>
      </div>
    </div>
    <div class="stack" style="display: inline-block;">
        <form class="ng-pristine ng-valid" ng-submit="createStack()">
        <h2>
            <input type="text" placeholder="Add a new stack" ng-focus="status.addStack=true" ng-blur="status.addStack=false" ng-model="newStack.title" required />
            <button class="icon icon-add" ng-show="status.addStack" type="submit"></button>
        </h2>
            </form>
      </div>
    </div>

    </div>

      </div>

