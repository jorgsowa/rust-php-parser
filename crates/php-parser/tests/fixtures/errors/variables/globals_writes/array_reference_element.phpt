===source===
<?php
$a = [&$GLOBALS, 'k' => &$GLOBALS];
===errors >=8.1===
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
===php_error >=8.1===
PHP Fatal error:  $GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax in Standard input code on line 2
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 13,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 21
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 23,
                          "end": 26
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 31,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 39
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 40
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
