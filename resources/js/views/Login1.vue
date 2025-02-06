
<template>
<div class="bg">
    <div class="ftco-section" style="height: 2080px;">
        <div class="main">
            <figure>
                  <!-- <img src="images/1a.jpg"/> -->
            </figure>
            <!--
            <div class="headline">
                <h2 class="text-headline">Sex-Disaggregated Data</h2>
            </div>
            -->
            <form v-on:submit.prevent="login">
                <span>
                    <label for="username" class="text-small-uppercase">Username</label>
                    <input class="text-body" id="username" name="username" type="text" required v-model="user.username">
                </span>
                <span>
                    <label for="email" class="text-small-uppercase">Password</label>
                    <input class="text-body" id="email" name="email" type="password" required v-model="user.password">
                </span>
                <input class="text-small-uppercase" id="submit" type="submit" value="LOGIN">
            </form>
        </div>
    </div>
</div>
</template>


<script>
    import * as authServices from '../services/auth_service';

    export default { 
        data() {
            return {
                user: {
                    username: '',
                    password: '',
                },
                isLogging: false
            }
        },
        methods: {
            login: async function () {
                try {
                    const response = await authServices.login(this.user);
                    // this.$router.push('/admin');
                    console.log(response.token_scope)
                    if(response.token_scope == 'superadmin'){
                        this.$router.push('/superadmin/dashboard');
                    } else if(response.token_scope == 'admin'){
                        this.$router.push('/admin/dashboard');
                    } else if(response.token_scope == 'author_hr'){
                        this.$router.push('/author/hr/dashboard');
                    } else if(response.token_scope == 'author_lib'){
                        this.$router.push('/author/library/dashboard');
                    } else if(response.token_scope == 'author_pjs'){
                        this.$router.push('/author/pjs/dashboard');
                    } else if(response.token_scope == 'author_sja'){
                        this.$router.push('/author/sja/dashboard');
                    } else if(response.token_scope == 'author_starbooks'){
                        this.$router.push('/author/starbooks/dashboard');
                    } else if(response.token_scope == 'author_dostv'){
                        this.$router.push('/author/dostv/dashboard');
                    }
                } catch(error) {
                    this.flashMessage.error({
                    message: 'Some error occured! Please try again.',
                    time: 5000
                    });
            }
            },
        },
    }
</script>