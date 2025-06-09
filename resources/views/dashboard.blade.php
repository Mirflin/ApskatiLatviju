<x-app-layout>
    <div x-data="adminPanel()" x-init="init()">
    <section id="main">
        <aside class="dashboard-aside">
            <div class="options">

                <button @click="setActive('start')" :class="active === 'start' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">Dashboard</p>
                    </div>
                </button>

                <div class="parrent-option">
                    <div class="parrent-label">
                        <div>
                            <img class="parrent-image">
                            <p class="function-p">Graphs</p>
                        </div>
                        <div>
                            <i class="fa-solid fa-circle-plus" style="color: #74C0FC;"></i>
                            <i class="fa-solid fa-chevron-up"></i>
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="child-option hidden-elem">
                        <a class="child">
                            <img class="child-option-image">
                            <div class="child-option-text">
                                <p>sommething</p>
                                <p>sommething</p>
                            </div>
                        </a>
                        <a class="child">
                            <img class="child-option-image">
                            <div class="child-option-text">
                                <p>sommething</p>
                                <p>sommething</p>
                            </div>
                        </a>
                        <a class="child">
                            <img class="child-option-image">
                            <div class="child-option-text">
                                <p>sommething</p>
                                <p>sommething</p>
                            </div>
                        </a>
                    </div>
                </div>

                <button @click="setActive('news')" :class="active === 'news' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">News</p>
                    </div>
                </button>

                <button @click="setActive('travels')" :class="active === 'travels' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">Travels</p>
                    </div>
                </button>

                <button @click="setActive('services')" :class="active === 'services' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">Services</p>
                    </div>
                </button>

                <button @click="setActive('history')" :class="active === 'history' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">Actions history</p>
                    </div>
                </button>
                <button @click="setActive('moderators')" :class="active === 'moderators' ? 'active' : ' '" class="parrent-label">
                    <div>
                        <img class="parrent-image">
                        <p class="function-p">Moderators</p>
                    </div>
                </button>
            </div>

            <div class="aside-footer">
                <div class="theme-changer">
                    <div class="white">
                        <img>
                        <p></p>
                    </div>
                    <div class="black">
                        <img>
                        <p></p>
                    </div>
                </div>
            </div>
        </aside>
        <template x-if="active === 'start'">
            @include('components.dashboard-start', ['breadcrumb' => 'dashboard/main'])
        </template>
        <template x-if="active === 'history'">
            @include('components.dashboard-history', ['breadcrumb' => 'dashboard/history'])
        </template>
        <template x-if="active === 'news'">
            @include('components.dashboard-news', ['breadcrumb' => 'dashboard/news'])
        </template>
        <template x-if="active === 'travels'">
            @include('components.dashboard-travels', ['breadcrumb' => 'dashboard/travels'])
        </template>
        <template x-if="active === 'services'">
            @include('components.dashboard-services', ['breadcrumb' => 'dashboard/services'])
        </template>
        <template x-if="active === 'moderators'">
            @include('components.dashboard-moderators', ['breadcrumb' => 'dashboard/moderators'])
        </template>
    </section>
    </div>
</x-app-layout>

<script>
    function adminPanel(){
        return{
            active: 'start',
            breadcrumb: '/dashboard',

            init(){
                const hash = window.location.hash.replace('#', '');
                if(['start', 'history','moderators','services','travels','news'].includes(hash)){
                    this.active = hash;
                }
                window.addEventListener('hashchange', () =>{
                    const newHash = window.location.hash.replace('#', '')
                    if(['start', 'history','moderators','services','travels','news'].includes(newHash)){
                        this.active = newHash;
                    }
                })
            },
            
            setActive(name){
                this.active = name;
                console.log(this.active)
                history.pushState(null, '', `#${name}`)
            },

        }
}
</script>