===source===
<?php
$f = function () use ($b) {
    static $b = 1;
};
===errors >=8.3===
Duplicate declaration of static variable $b
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $b in Standard input code on line 3
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
                  "Variable": "f"
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
                    "use_vars": [
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 28,
                            "end": 30
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 28,
                          "end": 30
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "b",
                                "span": {
                                  "start": 45,
                                  "end": 47
                                }
                              },
                              "default": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51
                                }
                              },
                              "span": {
                                "start": 45,
                                "end": 51
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 38,
                          "end": 52
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 54
          }
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
