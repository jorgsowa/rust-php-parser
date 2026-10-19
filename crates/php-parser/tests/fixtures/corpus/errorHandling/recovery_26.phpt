===source===
<?php
class A {
    /** @var ?string */
    private $foo

    public function __construct(string $s) {
        $this->foo = $s;
    }
}
class B {
    const X = 1
}
===errors===
expected ';', found 'public'
expected ';', found '}'
===php_error===
PHP Parse error:  syntax error, unexpected token "public", expecting "," or ";" in Standard input code on line 6
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
                    "name": "foo",
                    "span": {
                      "start": 52,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "doc_comment": {
                    "kind": "Doc",
                    "text": "/** @var ?string */",
                    "span": {
                      "start": 20,
                      "end": 39
                    }
                  }
                }
              },
              "span": {
                "start": 44,
                "end": 56
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 78,
                      "end": 89
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "s",
                        "span": {
                          "start": 97,
                          "end": 99
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 90,
                              "end": 96
                            }
                          }
                        },
                        "span": {
                          "start": 90,
                          "end": 96
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 90,
                        "end": 99
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 111,
                                        "end": 116
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "foo"
                                      },
                                      "span": {
                                        "start": 118,
                                        "end": 121
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 121
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "s"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 126
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 111,
                            "end": 126
                          }
                        }
                      },
                      "span": {
                        "start": 111,
                        "end": 127
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 62,
                "end": 133
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 135
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 142,
              "end": 143
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 156,
                      "end": 157
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 160,
                      "end": 161
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 150,
                "end": 161
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 136,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
