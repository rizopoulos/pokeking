<div class="text-center">
    <button @click="findKing" v-if="$root.showFindKingButton"
            :disabled="doingRequest"
            class="btn btn-success">FIND THE KING
    </button>
</div>

<div v-if="$root.king">
    <div class="king">
        <div class="thumbnail">
            <div class="text-center">
                <h2>Pokemon King</h2>
            </div>

            <img :src="$root.king.sprite">

            <div class="caption">
                <h3 v-text="$root.king.info.name"></h3>

                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge" v-text="$root.king.base_stat"></span>
                        <span>Base Stat</span>
                    </li>
                    <li class="list-group-item">
                        <span class="badge" v-text="$root.king.weight"></span>
                        <span>weight</span>
                    </li>
                    <li class="list-group-item">
                        <span class="badge" v-text="$root.king.height"></span>
                        <span>height</span>
                    </li>
                </ul>
                <div class="king__close" title="Hide King details" @click="$root.hideKing">
                    &times;
                </div>
                <p class="text-right king__info"
                   @click="$root.hideKing">
                    <small>Hide king details</small>
                </p>
            </div>
        </div>
    </div>
</div>