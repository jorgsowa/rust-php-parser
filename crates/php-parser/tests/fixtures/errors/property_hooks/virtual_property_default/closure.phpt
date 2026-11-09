===source===
<?php
class A {
    public $k = 1 { get => function () { return $this->k; }; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property A::$k
===errors >=8.4===
Cannot specify default value for virtual hooked property A::$k
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property A::$k in Standard input code on line 3
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
                    "name": "k",
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
                            "Closure": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "use_vars": [],
                              "return_type": null,
                              "body": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 64,
                                              "end": 69
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "k"
                                            },
                                            "span": {
                                              "start": 71,
                                              "end": 72
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 64,
                                        "end": 72
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 57,
                                    "end": 73
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 75
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 76
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 78
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
