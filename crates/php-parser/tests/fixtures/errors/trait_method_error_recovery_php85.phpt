===config===
min_php=8.5
===source===
<?php
trait LoggerTrait {
    public function log(string $msg): void { echo $msg; }
    @invalid
    public function error(string $msg): void { echo "ERROR: " . $msg; }
}
===errors===
expected class member, found '@'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "LoggerTrait",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "log",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "msg",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 50,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 56
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
                        "start": 50,
                        "end": 61
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 64,
                          "end": 68
                        }
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 68
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Variable": "msg"
                            },
                            "span": {
                              "start": 76,
                              "end": 80
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 71,
                        "end": 81
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 83
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "error",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "msg",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 123,
                              "end": 129
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 129
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
                        "start": 123,
                        "end": 134
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 137,
                          "end": 141
                        }
                      }
                    },
                    "span": {
                      "start": 137,
                      "end": 141
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "String": "ERROR: "
                                  },
                                  "span": {
                                    "start": 149,
                                    "end": 158
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "Variable": "msg"
                                  },
                                  "span": {
                                    "start": 161,
                                    "end": 165
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 149,
                              "end": 165
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 144,
                        "end": 166
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 101,
                "end": 168
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 170
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 170
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 4
