<template>
    <div class="container">
        <div class="progress" style="height: 40px" >
            <div class="progress-bar" role="progressbar" :style="{width: fileProgress + '%'}">{{ fileCurrent }}%</div>
        </div>
        <hr />
        <input type="file" name="image" value="" multiple  @change="fileInputChange"/>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="text-center">
                    Файлы в очереди ({{ fileOrder.lenght }})
                </h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in fileOrder" :key="file">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="text-center">Загруженные файлы {{ filesFinish.length  }}</h3>
                <ul class="list-group">
                    <li class="list-group-item" v-for="file in filesFinish" :key="file">
                        {{ file.name }} : {{ file.type }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        filesOder: [],
        filesFinish: [],
        fileProgress: 0,
        fileCurrent: ""
    }),
    methods:{
        async fileInputChange(){
            let files = Array.from(event.target.files);

            this.filesOder = files.slice();

            for(let item of files){
               await this.uploadFile(item);
            }
        },
        async uploadFile(item){
            let form = new FormData();
            form.append('image', item);

            await axios.post('image/upload', form, {
                onUploadProgress: (itemUpload)=>{
                    this.fileProgress = Math.round((itemUpload.loader / itemUpload.total) * 100);
                    this.fileCurrent = item.name + ' ' + this.fileProgress;
                }
            })
            .then(response=>{
                this.fileProgress = 0;
                this.fileCurrent = '';
                this.filesFinish.push(item);
                this.filesOder.splice(item, 1)
            })
            .catch(error=>{
                console.log(error);
            })
        }
    }
};
</script>
