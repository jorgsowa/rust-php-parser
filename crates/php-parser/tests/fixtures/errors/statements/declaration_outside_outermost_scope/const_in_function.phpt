===source===
<?php
function f() {
    const X = 1;
}
===errors===
'const' declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'const' (T_CONST) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Const": [
                  {
                    "name": {
                      "name": "X",
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    },
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    },
                    "attributes": [],
                    "span": {
                      "start": 31,
                      "end": 36
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
