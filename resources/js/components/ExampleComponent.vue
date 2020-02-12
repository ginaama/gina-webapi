<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ judul }}
                    </div>

                    <div
                    v-if="!loading" 
                    class="card-body">

                    <button 
                      class="btn btn-warning"
                      @click="aksesApi">
                      Refresh
                    </button>

                    <input 
                    v-model="katakunci" 
                    type="search" 
                    name="search" 
                    placeholder="Masukan kata kunci dan tekan enter"
                    @change="JalankanPencarian" />

                      <table
                        v-if="!error"
                       class="table table-bordered">
                           <tr>
                               <td>Nama</td>
                               <td>JK</td>
                               <td>Tanggal Dibuat</td>
                           </tr>
                           <tr v-for="item in data.data":key="item.id">
                               <td>{{ item.nama }}</td>
                               <td>{{ item.jk }} </td>
                               <td>{{ item.created_at }}</td>
                           </tr>
                       </table>

                       <pagination :data="data" @pagination-change-page="aksesApi">
                         <span slot="prev-nav">&lt; Previous</span>
                         <span slot="next-nav">Next &gt;</span>
                       </pagination>

                       <div v-if="error" class="alert alert-warning"> {{error}}</div>

                       <div v-if="loading" class="alert alert-warning"> {{error}}</div>
                    </div>
                </div>
            </div>
        </div>

        <notifications group="foo" />

        <vue-progress-bar></vue-progress-bar>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                judul: 'Data Siswa',
                data: {},
                error: null,
                loading: false,
                katakunci: ''
            }
        },

        mounted(){
            this.aksesApi()
        },

        methods: {
            aksesApi(page = 1, katakunci){
                this.$Progress.start()
                this.loading = true

                const params ={
                  page: page
                }

                if (katakunci){
                  params.katakunci = katakunci          
              }

                axios.get('/testapi?', {
                  params
                })
                .then(response => {
                    this.data = response.data
                    this.loading = false
                    this.$Progress.finish()
                    this.$notify({
                      type  : 'bg-warning',
                      group : 'foo',
                      title : 'Sukses',
                      text  : 'Data Berhasil Ditampilkan'
                    });
                })
                .catch(error=>{
                    this.error = error
                    this.loading = false
                    this.$Progress.fail()
                    this.$notify({
                      type  : 'bg-danger',
                      group : 'foo',
                      title : 'Error',
                      text  : error
                    });
                })
            },

            JalankanPencarian(){
              //
              this.aksesApi(1, this.katakunci)
            },
        }
    }
</script>