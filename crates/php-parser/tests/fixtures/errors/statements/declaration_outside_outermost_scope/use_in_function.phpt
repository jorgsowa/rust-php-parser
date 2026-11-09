===source===
<?php
function f() {
    use A\B;
}
===errors===
'use' declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'use' (T_USE) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "use" in Standard input code on line 3
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
                "Use": {
                  "kind": "Normal",
                  "uses": [
                    {
                      "name": {
                        "parts": [
                          "A",
                          "B"
                        ],
                        "kind": "Qualified",
                        "span": {
                          "start": 29,
                          "end": 32
                        }
                      },
                      "alias": null,
                      "span": {
                        "start": 29,
                        "end": 32
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 25,
                "end": 33
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
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
