===source===
<?php

function foo(Type) {
    $foo;
}

function foo(Type1 $foo, Type2) {
    $bar;
}

function foo(...) {
    $baz;
}

function foo(&) {
    $qux;
}

function foo(Bar)

class Bar {
    function foo(Baz)
}

function(Foo);
===errors===
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected variable, found ')'
expected '{', found 'class'
expected variable, found ')'
expected ';', found '}'
expected variable, found ')'
expected '{', found ';'
expected '}', found end of file
expected ';' after expression
unclosed ''}'' opened at Span { start: 171, end: 176 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "<error>",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 20,
                "end": 24
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "foo"
                  },
                  "span": {
                    "start": 32,
                    "end": 36
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 37
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 39
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "foo",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type1"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 54,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 54,
                  "end": 59
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 54,
                "end": 64
              }
            },
            {
              "name": "<error>",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type2"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 66,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 71
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 66,
                "end": 71
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "bar"
                  },
                  "span": {
                    "start": 79,
                    "end": 83
                  }
                }
              },
              "span": {
                "start": 79,
                "end": 84
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 86
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "<error>",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 101,
                "end": 104
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "baz"
                  },
                  "span": {
                    "start": 112,
                    "end": 116
                  }
                }
              },
              "span": {
                "start": 112,
                "end": 117
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 88,
        "end": 119
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "<error>",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 134,
                "end": 135
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Variable": "qux"
                  },
                  "span": {
                    "start": 143,
                    "end": 147
                  }
                }
              },
              "span": {
                "start": 143,
                "end": 148
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 121,
        "end": 150
      }
    },
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "<error>",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 165,
                      "end": 168
                    }
                  }
                },
                "span": {
                  "start": 165,
                  "end": 168
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 165,
                "end": 168
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Class": {
                  "name": "Bar",
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
                          "name": "foo",
                          "visibility": null,
                          "is_static": false,
                          "is_abstract": false,
                          "is_final": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": "<error>",
                              "type_hint": {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Baz"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 200,
                                      "end": 203
                                    }
                                  }
                                },
                                "span": {
                                  "start": 200,
                                  "end": 203
                                }
                              },
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "is_readonly": false,
                              "is_final": false,
                              "visibility": null,
                              "set_visibility": null,
                              "attributes": [],
                              "span": {
                                "start": 200,
                                "end": 203
                              }
                            }
                          ],
                          "return_type": null,
                          "body": null,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 187,
                        "end": 204
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 171,
                "end": 206
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Closure": {
                      "is_static": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "<error>",
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 217,
                                  "end": 220
                                }
                              }
                            },
                            "span": {
                              "start": 217,
                              "end": 220
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "is_readonly": false,
                          "is_final": false,
                          "visibility": null,
                          "set_visibility": null,
                          "attributes": [],
                          "span": {
                            "start": 217,
                            "end": 220
                          }
                        }
                      ],
                      "use_vars": [],
                      "return_type": null,
                      "body": [
                        {
                          "kind": "Nop",
                          "span": {
                            "start": 221,
                            "end": 222
                          }
                        }
                      ],
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 208,
                    "end": 222
                  }
                }
              },
              "span": {
                "start": 208,
                "end": 222
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 152,
        "end": 222
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 222
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ")", expecting variable in Standard input code on line 3
