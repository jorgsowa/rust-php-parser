===source===
<?php
$f = function () use (&$a) {
    static $a;
};
===errors >=8.3===
Duplicate declaration of static variable $a
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 3
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
                          "name": "a",
                          "span": {
                            "start": 29,
                            "end": 31
                          }
                        },
                        "by_ref": true,
                        "span": {
                          "start": 28,
                          "end": 31
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
                                "name": "a",
                                "span": {
                                  "start": 46,
                                  "end": 48
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 46,
                                "end": 48
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 39,
                          "end": 49
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 51
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
