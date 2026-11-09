===source===
<?php
[$a, [$GLOBALS]] = $a;
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
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
                                      "start": 12,
                                      "end": 20
                                    }
                                  }
                                },
                                "span": {
                                  "start": 12,
                                  "end": 20
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 11,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 25,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
