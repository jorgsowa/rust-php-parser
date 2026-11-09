===source===
<?php
[$GLOBALS] = [1];
===errors >=8.1===
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 7,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
