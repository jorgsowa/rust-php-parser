===source===
<?php
$g = function () { static $a; static $a; };
===errors >=8.3===
Duplicate declaration of static variable $a
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 2
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
                  "Variable": "g"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "a",
                                "span": {
                                  "start": 32,
                                  "end": 34
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 32,
                                "end": 34
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 25,
                          "end": 35
                        }
                      },
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "a",
                                "span": {
                                  "start": 43,
                                  "end": 45
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 43,
                                "end": 45
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 36,
                          "end": 46
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
