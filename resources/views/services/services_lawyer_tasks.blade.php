                          @foreach($tasks_months as $month=>$tasks)
                          <div class="col-lg-12">
                            <div class="panel panel-default">
                              <div class="panel-heading" id="heading-1{{$month}}" role="tab">
                                <h4 class="panel-title bgcolor--main_l bradius--noborder bshadow--1 padding--small margin--small-top-bottom"><a class="trigger color--white" role="button" data-toggle="collapse" href="#collapse-1{{$month}}" aria-expanded="true" aria-controls="collapse-1">
                                  <div class="col-xs-11">{{$month}}<span class="pull-right color--fadeorange">مهمات {{count($tasks)}}</span></div>
                                  <div class="clearfix"></div></a></h4>
                                </div>
                              </div>

                              <div class="panel-collapse collapse" id="collapse-1{{$month}}" role="tabpanel" aria-labelledby="heading-1" aria-expanded="true">
                                <div class="panel-body bgcolor--white bradius--noborder bshadow--1 padding--small margin--small-top-bottom">
                                  @foreach($tasks as $task)
                                  <div class="col-md-12 right-text"><span class="bgcolor--main_l color--white bradius--small importance padding--small">{{Helper::localizations('task_types','name',$task['task_type_id'])}}</span> &nbsp;<a href="case_view.html">{{$task['name']}} </a>
                                    <div class="pull-right">
                                      <label class="data-label-round bgcolor--fadegreen color--white">{{$task['start_datetime']->format('Y - m - d')}}</label>
                                    </div>
                                  </div>
                                  <div class="clearfix"></div>
                                  <hr>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                            @endforeach