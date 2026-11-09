===source===
<?php
class A {
    public $p { get { static $a; static $a; return 1; } }
}
===errors <=8.2===
'property hooks' requires PHP 8.4 or higher
===errors 8.3===
'property hooks' requires PHP 8.4 or higher
Duplicate declaration of static variable $a
===errors >=8.4===
Duplicate declaration of static variable $a
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "StaticVar": [
                                {
                                  "name": {
                                    "name": "a",
                                    "span": {
                                      "start": 45,
                                      "end": 47
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 45,
                                    "end": 47
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 38,
                              "end": 48
                            }
                          },
                          {
                            "kind": {
                              "StaticVar": [
                                {
                                  "name": {
                                    "name": "a",
                                    "span": {
                                      "start": 56,
                                      "end": 58
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 56,
                                    "end": 58
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 49,
                              "end": 59
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 67,
                                  "end": 68
                                }
                              }
                            },
                            "span": {
                              "start": 60,
                              "end": 69
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 71
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 73
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
