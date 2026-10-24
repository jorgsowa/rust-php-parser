===source===
<?php
class A {
    public $a { GET() {} }
    public $b { SET($x, $y) {} }
    public $c { get; GET; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
get hook of property must not have a parameter list
'property hooks' requires PHP 8.4 or higher
set hook must have exactly one parameter
'property hooks' requires PHP 8.4 or higher
Cannot redeclare property hook "GET"
Non-abstract property hook must have a body
Non-abstract property hook must have a body
===errors >=8.4===
get hook of property must not have a parameter list
set hook must have exactly one parameter
Cannot redeclare property hook "GET"
Non-abstract property hook must have a body
Non-abstract property hook must have a body
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  get hook of property A::$a must not have a parameter list in Standard input code on line 3
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
                    "name": "a",
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
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "empty_param_list": true,
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 40
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 42
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 54,
                      "end": 56
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
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "x",
                            "span": {
                              "start": 63,
                              "end": 65
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        },
                        {
                          "name": {
                            "name": "y",
                            "span": {
                              "start": 67,
                              "end": 69
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 67,
                            "end": 69
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 73
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 47,
                "end": 75
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 87,
                      "end": 89
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
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 92,
                        "end": 96
                      }
                    },
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 97,
                        "end": 101
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 80,
                "end": 103
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}
