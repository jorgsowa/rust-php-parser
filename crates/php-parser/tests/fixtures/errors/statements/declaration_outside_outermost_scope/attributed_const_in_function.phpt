===source===
<?php
function f() {
    #[A] const Y = 2;
}
===errors 8.0-8.4===
'const' declarations can only be used at the outermost scope
'attributes on constants' requires PHP 8.5 or higher
===errors >=8.5===
'const' declarations can only be used at the outermost scope
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 3
===ast <=7.4===
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
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
===ast >=8.0===
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
                      "name": "Y",
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    },
                    "value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 40,
                        "end": 41
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 28
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      }
                    ],
                    "span": {
                      "start": 36,
                      "end": 41
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 42
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
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
