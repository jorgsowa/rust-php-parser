===source===
<?php
$o = new class {
    public $c = 1 { get => 2; }
};
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property class@anonymous::$c
===errors >=8.4===
Cannot specify default value for virtual hooked property class@anonymous::$c
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Cannot specify default value for virtual hooked property class@anonymous::$c in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  Cannot specify default value for virtual hooked property class@anonymous in Standard input code on line 3
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
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                    "name": "c",
                                    "span": {
                                      "start": 34,
                                      "end": 36
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": null,
                                  "default": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 39,
                                      "end": 40
                                    }
                                  },
                                  "attributes": [],
                                  "hooks": [
                                    {
                                      "kind": "Get",
                                      "body": {
                                        "Expression": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 50,
                                            "end": 51
                                          }
                                        }
                                      },
                                      "by_ref": false,
                                      "params": [],
                                      "attributes": [],
                                      "span": {
                                        "start": 43,
                                        "end": 52
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 54
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 56
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 56
          }
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
