                        <div>

                    
                        <button class="pure-button pure-button-primary" type="button" onclick="this.parentNode.querySelector(\'[type=number]\').stepDown();">
                            <i class="fas fa-minus fa-sm"></i>
                        </button>                      

                        <input class="number" type="number" name="item_' .$item->ID . '" min="0" max="10" value="0" step="1"> 
                        
                        <button class="pure-button pure-button-primary" type="button" onclick="this.parentNode.querySelector(\'[type=number]\').stepUp();">
                            <i class="fas fa-plus fa-sm"></i>
                        </button>                       

                    </div> 