<?php
/**
 * @copyright Copyright &copy; Zertex, 2017
 * @package yii2-gridview-pagesize-widget
 * @version 1.0.0
 */

namespace zertex\gridpagesize;
use yii\helpers\Html;
/**
 * GridPageSize расширение для \yii\grid\GridView, которое
 * отображает выпадающий список значений для изменения количества
 * записей.
 *
 * Над или под GridView подклбчите виджет:
 *
 * ~~~
 * <?php echo \zertex\GridPageSize::widget($options); ?>
 * ~~~
 *
 * укажите параметр `filterSelector` в GridView как в примере.
 *
 * ~~~
 * <?= GridView::widget([
 *      'dataProvider' => $dataProvider,
 *      'filterModel' => $searchModel,
 * 		'filterSelector' => 'select[name="per-page"]',
 *      'columns' => [
 *          ...
 *      ],
 *  ]); ?>
 * ~~~
 *
 *
 * @author Zertex <info@zertex.ru>
 * @since 1.0
 */
class GridPageSize extends \yii\base\Widget
{
	/**
	 * @var string
	 */
	public $label = 'items';

	/**
	 * @var integer
	 */
	public $defaultPageSize = 20;

	/**
	 * @var string - GET param - size of the page
	 */
	public $pageSizeParam = 'per-page';

	/**
	 * @var array the list of page sizes
	 */
	public $sizes = [5, 10, 20, 50, 100, 200];

	/**
	 * @var string the template to be used for rendering the output
	 */
	public $template = '{label} {list}';

	/**
	 * @var array - options for the dropdown list
	 */
	public $options;

	/**
	 * @var array - options for the label
	 */
	public $labelOptions;

	/**
	 * @var boolean - encoding label text
	 */
	public $encodeLabel = true;

    /**
     * Callback function on get new page size
     */
    public $callback;

	/**
	 * Runs the widget and render the output
	 */
	public function run()
	{
		if(empty($this->options['id'])) {
			$this->options['id'] = $this->id;
		}

		if($this->encodeLabel) {
			$this->label = Html::encode($this->label);
		}

        $perPage = filter_input(INPUT_GET, $this->pageSizeParam, FILTER_VALIDATE_INT);
        if ($perPage) {
            $this->doStuff()->__invoke($perPage);
        }
        else {
            $perPage = $this->defaultPageSize;
        }

		$listHtml = Html::dropDownList($this->pageSizeParam, $perPage, array_combine($this->sizes, $this->sizes), $this->options);
		$labelHtml = Html::label($this->label, $this->options['id'], $this->labelOptions);

		return str_replace(['{list}', '{label}'], [$listHtml, $labelHtml], $this->template);
	}

    public function doStuff(){
    	if (is_callable($this->callback)) {
    		return $this->callback;
    	}
        return function(){};
    }
}
