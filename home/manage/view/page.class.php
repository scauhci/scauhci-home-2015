<?php

class Page
{
    private $total;         //数据表中总记录数
    private $listRows;         //每页显示行数
    private $limit;         //SQL语句使用limit从句，限制获取记录的个数
    private $url;             //自动获取url的请求地址
    private $pageNum;         //总页数
    private $page;             //当前页
    private $type;             //操作类型
    private $config = array(
        'head' => "条记录",
        'prev' => "<<",
        'next' => ">>",
        'first' => "first",
        'last' => "last",
    );
    private $listNum = 6;        //默认分页列表显示的个数


    public function __construct($total, $type, $listRows = 5, $query = "", $ord = true)
    {

        $this->total = $total;
        $this->type = $type;
        $this->listRows = $listRows;
        $this->url = './index.php?';
        $this->pageNum = ceil($this->total / $this->listRows);

        if (isset($_GET["art"]) && isset($_GET["act"]) && isset($_GET["pep"])) {
            $this->page = array(
                'art' => $_GET["art"],
                'act' => $_GET["act"],
                'pep' => $_GET["pep"]);

        } else {
            $this->page = array('art' => 1, 'act' => 1, 'pep' => 1);
        }
        $this->limit = " limit " . $this->setLimit();
    }

    /**
     * 用于显示分页信息
     * @param string $param 是成员属性数组config的下标
     * @param string $value 用于设置config下标对应的元素值
     * @return       返回对象本身
     */

    function set($param, $value)
    {
        if (array_key_exists($param, $this->config)) {
            $this->config[$param] = $value;
        }
        return $this;
    }

    /*通过该方法，可以使用在对象外部直接获取私有成员属性limit和page的值*/
    function __get($args)
    {
        if ($args == "limit" || $args == "page") {
            return $this->args;
        } else {
            return null;
        }
    }

    /*按指定格式输出页*/

    public function fpage($cou)
    {
        $html[0] = "&nbsp;共<b>{$this->total}</b>{$this->config["head"]}&nbsp;";
        if ($cou > 0) {
            $html[1] = "&nbsp;<b>{$this->page[$this->type]}/{$this->pageNum}</b>页&nbsp;";
            $html[2] = $this->firstprev();
            $html[3] = $this->pageList();
            $html[4] = $this->nextlast();
            //  $html[5] = $this->goPage();
        }
        $fpage = '<nav class="pull-right"><ul class="pagination">';
        for ($i = 0; $i < 5; $i++) {
            $fpage .= $html[$i];
        }
        $fpage .= '</ul></nav>';
        return $fpage;
    }

    private function setLimit()
    {
        if ($this->page[$this->type] > 0) {
            return ($this->page[$this->type] - 1) * $this->listRows . ",{$this->listRows}";
        } else {
            return 0;
        }
    }

    /*获取当前页开始的记录数*/

    private function start()
    {
        if ($this->total == 0) {
            return 0;
        } else {
            return ($this->page[$this->type] - 1) * $this->listRows + 1;
        }
    }

    /*获取当前页结束的记录数*/

    private function end()
    {
        return min($this->page[$this->type] * $this->listRows, $this->total);
    }

    /*获取上一页和首页的操作信息*/
    private function firstprev()
    {
        if ($this->page[$this->type] > 1) {
            //	$str = "<ul class="pagination"><li><a href='{$this->url}page=1'><span aria-hidden="true">&laquo;</span></a></li>";
            $this->page[$this->type]--;
            $str = "<li><a href='{$this->url}art=" . ($this->page["art"]) . "&act=" . ($this->page["act"]) . "&pep=" . ($this->page["pep"]) . "'>{$this->config["prev"]}</a></li>";

            return $str;
        }
    }


    /*获取列表信息*/

    private function pageList()
    {
        $linkPage = "";

        $inum = floor($this->listNum / 2);
        //当前页前面的列表
        $page = $this->page;
        for ($i = $inum; $i >= 1; $i--) {
            $page[$this->type] = $this->page[$this->type] - $i;

            if ($page[$this->type] >= 1) {
                $linkPage .= "<li><a href='{$this->url}art=" . ($page["art"]) . "&act=" . ($page["act"]) . "&pep=" . ($page["pep"]) . "'>{$page[$this->type]}</a></li>";
            }
        }


        //当前页的信息
        if ($this->pageNum > 1) {
            $linkPage .= "<li><a href='{$this->url}art=" . ($this->page["art"]) . "&act=" . ($this->page["act"]) . "&pep=" . ($this->page["pep"]) . "'>{$this->page[$this->type]}</a></li>";
        }

        //当前页后面的列表
        $page = $this->page;
        for ($i = 1; $i <= $inum; $i++) {
            $page[$this->type]++;
            if ($page[$this->type] <= $this->pageNum) {
                $linkPage .= "<li><a href='{$this->url}art=" . ($page["art"]) . "&act=" . ($page["act"]) . "&pep=" . ($page["pep"]) . "'>{$page[$this->type]}</a></li>";
            } else {
                break;
            }
        }

        return $linkPage;
    }


    /*下一页和尾页的操作信息*/

    private function nextlast()
    {
        $page = $this->page;
        if ($page[$this->type] != $this->pageNum) {
            $page[$this->type]++;
            $str = "<li><a href='{$this->url}art=" . ($page["art"]) . "&act=" . ($page["act"]) . "&pep=" . ($page["pep"]) . "'>{$this->config['next']}</a></li>";
            return $str;
        }


    }

    public function getLimit()
    {
        return $this->limit;
    }


    public function setType($type)
    {
        $this->type = $type;
    }
}

?>