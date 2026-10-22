===source===
<?php
fn($foo, ) => $bar;
===errors <=7.4===
'trailing comma in parameter list' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting variable (T_VARIABLE) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": {
                    "name": "foo",
                    "span": {
                      "start": 9,
                      "end": 13
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 13
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Variable": "bar"
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
