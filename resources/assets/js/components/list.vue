<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul>
                    <li v-for="list in user">{{user.name}}</li>
                </ul>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
    	data () {
    		return {
    			list:[
                    {'name': 'user01'},
                    {'name': 'user01'},
                    {'name': 'user02'},
                    {'name': 'user04'},
                    {'name': 'user05'},
                    {'name': 'user06'},
                ]
            }
        }
    }

</script>