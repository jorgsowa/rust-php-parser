===source===
<?php
$h = fn() => function () { static $a, $a; };
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
                  "Variable": "h"
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
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
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
                                        "start": 40,
                                        "end": 42
                                      }
                                    },
                                    "default": null,
                                    "span": {
                                      "start": 40,
                                      "end": 42
                                    }
                                  },
                                  {
                                    "name": {
                                      "name": "a",
                                      "span": {
                                        "start": 44,
                                        "end": 46
                                      }
                                    },
                                    "default": null,
                                    "span": {
                                      "start": 44,
                                      "end": 46
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 33,
                                "end": 47
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 49
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
