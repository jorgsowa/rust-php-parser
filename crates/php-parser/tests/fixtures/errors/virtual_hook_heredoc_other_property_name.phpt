===source===
<?php
class C { public int $p = 1 { get => $this->{<<<X
q
X}; } }
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot specify default value for virtual hooked property C::$p
===errors >=8.4===
Cannot specify default value for virtual hooked property C::$p
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot specify default value for virtual hooked property C::$p in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 23,
                          "end": 26
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 43,
                                  "end": 48
                                }
                              },
                              "property": {
                                "kind": {
                                  "Heredoc": {
                                    "label": "X",
                                    "parts": [
                                      {
                                        "Literal": "q"
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 59
                                }
                              }
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
                        "end": 61
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
