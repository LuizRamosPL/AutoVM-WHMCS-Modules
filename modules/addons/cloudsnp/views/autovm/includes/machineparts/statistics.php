<div class="row m-0 p-0">
    <div class="col-12 m-0 p-0 mb-5">

        <div v-if="!hasMemoryLiniar || !hasCPULiniar" class="row m-0 p-0 justify-content-center">
            <?php  include('./includes/commodules/fetchingdata.php');     ?>
        </div>

        <div v-show="hasMemoryLiniar && hasCPULiniar" class="row m-0 p-0 justify-content-center">
            
            <!-- Memory -->
            <div class="col-12 col-xl-6 m-0 p-0">
                <div class="rounded-4 shadow p-2 p-md-4 p-lg-3 p-xxl-4 mx-3 mx-xl-4 mb-5">
                    <div class="RAMLinear"></div>
                </div>  
            </div>
            
            
            <!-- CPU -->
            <div class="col-12 col-xl-6 m-0 p-0">
                <div class="rounded-4 shadow p-2 p-md-4 p-lg-3 p-xxl-4 mx-3 mx-xl-4 mb-5">
                    <div class="CPULinear"></div>
                </div>
            </div>


        </div>

        
    </div>
</div>