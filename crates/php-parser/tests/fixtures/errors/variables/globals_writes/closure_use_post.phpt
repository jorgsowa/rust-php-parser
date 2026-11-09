===source===
<?php
function () use ($_POST) {};
===errors===
Cannot use auto-global as lexical variable
===php_error===
PHP Fatal error:  Cannot use auto-global as lexical variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "_POST",
                    "span": {
                      "start": 23,
                      "end": 29
                    }
                  },
                  "by_ref": false,
                  "span": {
                    "start": 23,
                    "end": 29
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
