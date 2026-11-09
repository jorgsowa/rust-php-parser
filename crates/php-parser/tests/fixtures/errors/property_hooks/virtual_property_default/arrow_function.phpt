===source===
<?php
class A {
    public $j = 1 { get => fn() => $this->j; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$j
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$j
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$j in Standard input code on line 3
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
                    "name": "j",
                    "span": {
                      "start": 27,
                      "end": 29
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
                      "start": 32,
                      "end": 33
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "ArrowFunction": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "return_type": null,
                              "body": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 51,
                                        "end": 56
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "j"
                                      },
                                      "span": {
                                        "start": 58,
                                        "end": 59
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 59
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 59
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 60
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
