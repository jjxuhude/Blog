<template>

    <div class="block">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Example Component</div>


                        <div class="panel-body">

                            我是徐华德
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <el-button @click="ajax()">按钮</el-button>
                    <el-dialog v-model="visible">
                        <p>欢迎使用 Element</p>
                    </el-dialog>
                </div>
            </div>
        </div>

        <router-view></router-view>



    </div>
</template>

<script>
	export default {
		data: function () {
			return {
				visible: false
			}
		},
		methods: {
			ajax: function () {
				var formData= new FormData();
				formData.append('name','xuhuade');
				formData.append('age','18岁');
				//this.$http({'method':'POST','url':'/ajax/list',formData,emulateHTTP:true,emulateJSON:true}).then(function (response) {
				this.$http.post('/ajax/list',formData).then(function (response) {
                    console.log(response.body);
				});
			}
		},
		mounted: function() {
			console.log ('Component mounted.')
		}

	}
</script>
