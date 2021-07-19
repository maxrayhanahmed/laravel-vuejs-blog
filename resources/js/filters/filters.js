
  import { stubString } from 'lodash';
import moment from 'moment';
  import Vue from 'vue';

  Vue.filter('time', function(a){
    return moment(a).format('MMMM d, YYYY');
  });

  Vue.filter('readMore', function(content, length, dotString){

    return content.substring(0, length)+dotString;
  });
