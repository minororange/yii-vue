/**
 * 全局公用方法
 *
 * @type {{toast(string, string=, int=, Function=): void, confirm(string, string, string=, string=, Function=, Function=): void}}
 */
const global = {
  /**
   * 用来显示「成功、警告、消息、错误」类的操作反馈
   *
   * @param {string} message 提示信息
   * @param {string} type 类别可选参数：success/warning/info/error
   * @param {int} duration 显示时长 单位：毫秒
   * @param {function} onClose 关闭时回调函数
   */
  toast(message, type = 'success', duration = 1000, onClose = null)
  {
    let option = {message, type, duration};

    if(typeof onClose === 'function')
    {
      option.onClose = onClose;
    }

    Bus.$message(option);
  },
  /**
   * confirm提示框
   *
   * @param {string} message 提示信息
   * @param {string} title 提示标题
   * @param {function} confirmCallBack 确认回调
   * @param {function} cancelCallBack 取消回调
   * @param {string}  confirmButtonText 确认按钮文字
   * @param {string}  cancelButtonText 取消按钮文字
   */
  confirm(message, title, confirmCallBack = null, cancelCallBack = null, confirmButtonText = '确定', cancelButtonText = '取消')
  {
    let option = {
      title, confirmButtonText, cancelButtonText,
      showCancelButton: true,
      showConfirmButton: true,
      lockScroll: true,
      showClose: true,
      closeOnPressEscape: true,
      callback(action)
      {
        if(action === 'confirm' && typeof confirmCallBack === 'function')
        {
          confirmCallBack();
        }
        if(action === 'cancel' && typeof cancelCallBack === 'function')
        {
          cancelCallBack();
        }
      }
    };

    Bus.$alert(message, option);
  }
};

export default global;