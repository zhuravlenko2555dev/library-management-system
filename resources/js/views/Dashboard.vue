<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-green">
                    <div class="inner">
                        <h3>{{booksCount}}</h3>
                        <p>Total books</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-purple">
                    <div class="inner">
                        <h3>{{readersCount}}</h3>
                        <p>Total readers</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-cyan">
                    <div class="inner">
                        <h3>{{borrowedCount}}</h3>
                        <p>Borrowed books</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-share"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-red">
                    <div class="inner">
                        <h3>{{nonReturnCount}}</h3>
                        <p>Non-return books</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Borrowed books in this month
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="bar-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Popular books</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                            <tr>
                                <th>Book</th>
                                <th>Count of&nbsp;reads</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(book, key) in booksPopular">
                                <td>
                                    <div class="mr-2" style="width: 48px; display: inline-block; text-align: center;">
                                        <img onerror="this.src = 'img/book.svg'; this.onerror = '';"  v-bind:src="/storage/ + book.image_small" v-bind:alt="book.name" style="height: 48px;">
                                    </div>
                                    {{book.name}}
                                </td>
                                <td>{{book.count_of_reads}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Active readers</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-valign-middle">
                            <thead>
                            <tr>
                                <th>Reader</th>
                                <th>Borrowed books</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(reader, key) in readersActive">
                                <td>
                                    <div class="mr-2" style="width: 48px; display: inline-block; text-align: center;">
                                        <img class="img-circle" v-if="reader.photo" v-bind:src="/storage/ + reader.photo" v-bind:alt="reader.surname + '&nbsp;' + reader.name + '&nbsp;' + reader.middle_name" style="height: 48px;">
                                        <img class="img-circle" v-else v-bind:src="avatarPath(reader.gender)" v-bind:alt="reader.surname + '&nbsp;' + reader.name + '&nbsp;' + reader.middle_name" style="height: 48px;">
                                    </div>
                                    &nbsp;{{reader.surname + "&nbsp;" + reader.name + "&nbsp;" + reader.middle_name}}
                                </td>
                                <td>{{reader.borrowed_books}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "Dashboard",
    metaInfo: {
        title: 'Dashboard'
    },
    computed: {
        ...mapGetters([
            'booksCount',
            'readersCount',
            'borrowedCount',
            'nonReturnCount',
            'borrowedGraphThisMonth',
            'booksPopular',
            'readersActive']),
    },
    methods: {
        avatarPath: function(gender) {
            if (gender === 'm')
                return 'img/male.png'
            else
                return 'img/female.png'
        }
    },
    created() {
        this.$store.dispatch('booksCount')
            .then(() => {})
            .catch(err => {});
        this.$store.dispatch('readersCount')
            .then(() => {})
            .catch(err => {});
        this.$store.dispatch('borrowedCount')
            .then(() => {})
            .catch(err => {});
        this.$store.dispatch('nonReturnCount')
            .then(() => {})
            .catch(err => {});

        this.$store.dispatch('booksPopular')
            .then(() => {})
            .catch(err => {});
        this.$store.dispatch('readersActive')
            .then(() => {})
            .catch(err => {});
    },
    mounted() {
        this.$store.dispatch('borrowedGraphThisMonth')
            .then(() => {
                let today = new Date();
                let lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();

                let bar_data = {
                    bars: { show: true }
                }
                let dataValues = [];
                let dataTicks = [];
                this.borrowedGraphThisMonth.forEach(function(item, i, arr) {
                    dataValues.push([(i + 1), item.value]);
                    dataTicks.push([(i + 1), item.label + '']);
                });
                for (let i = dataValues.length; i < lastDayOfMonth; i++) {
                    dataValues.push([(i + 1), 0]);
                    dataTicks.push([(i + 1), '']);
                }
                bar_data.data = dataValues;

                $.plot('#bar-chart', [bar_data], {
                    grid  : {
                        borderWidth: 1,
                        borderColor: '#f3f3f3',
                        tickColor  : '#f3f3f3'
                    },
                    series: {
                        bars: {
                            show: true, barWidth: 0.5, align: 'center',
                        },
                    },
                    colors: ['#3c8dbc'],
                    xaxis : {
                        ticks: dataTicks
                    }
                });
            })
            .catch(err => {});
    }
}
</script>

<style scoped>

</style>
