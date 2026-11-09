===source===
<?php
declare(ticks=1) { use D; }
===errors===
'use' declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'use' (T_USE) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "use" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Use": {
                      "kind": "Normal",
                      "uses": [
                        {
                          "name": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 29,
                              "end": 30
                            }
                          },
                          "alias": null,
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 31
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 33
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
