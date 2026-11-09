===source===
<?php
class A {
    public function m() { static $a; static $a; }
}
===errors >=8.3===
Duplicate declaration of static variable $a
===php_error >=8.3===
PHP Fatal error:  Duplicate declaration of static variable $a in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "a",
                              "span": {
                                "start": 49,
                                "end": 51
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 49,
                              "end": 51
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 42,
                        "end": 52
                      }
                    },
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "a",
                              "span": {
                                "start": 60,
                                "end": 62
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 60,
                              "end": 62
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 53,
                        "end": 63
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
