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
                      "end": 24,
                      "start_line": 3,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 13
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
                "end": 24,
                "start_line": 3,
                "start_col": 13
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
                    "end": 36,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 38,
                "start_line": 4,
                "start_col": 4
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
        "end": 39,
        "start_line": 3,
        "start_col": 0
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
                      "end": 60,
                      "start_line": 7,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 54,
                  "end": 60,
                  "start_line": 7,
                  "start_col": 13
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
                "end": 64,
                "start_line": 7,
                "start_col": 13
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
                      "end": 71,
                      "start_line": 7,
                      "start_col": 25
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 71,
                  "start_line": 7,
                  "start_col": 25
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
                "end": 71,
                "start_line": 7,
                "start_col": 25
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
                    "end": 83,
                    "start_line": 8,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 79,
                "end": 85,
                "start_line": 8,
                "start_col": 4
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
        "end": 86,
        "start_line": 7,
        "start_col": 0
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
                "end": 104,
                "start_line": 11,
                "start_col": 13
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
                    "end": 116,
                    "start_line": 12,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 112,
                "end": 118,
                "start_line": 12,
                "start_col": 4
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
        "end": 119,
        "start_line": 11,
        "start_col": 0
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
                "end": 135,
                "start_line": 15,
                "start_col": 13
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
                    "end": 147,
                    "start_line": 16,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 143,
                "end": 149,
                "start_line": 16,
                "start_col": 4
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
        "end": 150,
        "start_line": 15,
        "start_col": 0
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
                      "end": 168,
                      "start_line": 19,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 165,
                  "end": 168,
                  "start_line": 19,
                  "start_col": 13
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
                "end": 168,
                "start_line": 19,
                "start_col": 13
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
                                      "end": 203,
                                      "start_line": 22,
                                      "start_col": 17
                                    }
                                  }
                                },
                                "span": {
                                  "start": 200,
                                  "end": 203,
                                  "start_line": 22,
                                  "start_col": 17
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
                                "end": 203,
                                "start_line": 22,
                                "start_col": 17
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
                        "end": 205,
                        "start_line": 22,
                        "start_col": 4
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 171,
                "end": 206,
                "start_line": 21,
                "start_col": 0
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
                                  "end": 220,
                                  "start_line": 25,
                                  "start_col": 9
                                }
                              }
                            },
                            "span": {
                              "start": 217,
                              "end": 220,
                              "start_line": 25,
                              "start_col": 9
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
                            "end": 220,
                            "start_line": 25,
                            "start_col": 9
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
                            "end": 222,
                            "start_line": 25,
                            "start_col": 13
                          }
                        }
                      ],
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 208,
                    "end": 222,
                    "start_line": 25,
                    "start_col": 0
                  }
                }
              },
              "span": {
                "start": 208,
                "end": 222,
                "start_line": 25,
                "start_col": 0
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
        "end": 222,
        "start_line": 19,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 222,
    "start_line": 1,
    "start_col": 0
  }
}
