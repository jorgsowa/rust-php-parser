===source===
<?php $y = #[Attr] static fn($a) => $a;
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 29,
                            "end": 31
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 29,
                          "end": 31
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 36,
                        "end": 38
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attr"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 13,
                            "end": 17
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 13,
                          "end": 17
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 38
          }
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
