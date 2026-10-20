===source===
<?php
namespace M {
    function f(namespace\Foo\callable $a, ?namespace\self $b) {}
}
namespace {
    function f(namespace\Foo\int $a, namespace\iterable $b) {}
}
===errors===
Cannot use "M\Foo\callable" as a type name as it is reserved
Cannot use "Foo\int" as a type name as it is reserved
Type declaration 'iterable' must be unqualified
Cannot use "self" when no class scope is active
===php_error <=8.4===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot use "M\Foo\callable" as a type name as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "M"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 33,
                        "end": 34
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 58,
                            "end": 60
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo",
                                "callable"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 35,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 57
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 35,
                          "end": 60
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 78,
                            "end": 80
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Relative",
                                  "span": {
                                    "start": 63,
                                    "end": 77
                                  }
                                }
                              },
                              "span": {
                                "start": 63,
                                "end": 77
                              }
                            }
                          },
                          "span": {
                            "start": 62,
                            "end": 77
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 62,
                          "end": 80
                        }
                      }
                    ],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 24,
                  "end": 84
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 86
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 112,
                        "end": 113
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 132,
                            "end": 134
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Foo",
                                "int"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 114,
                                "end": 131
                              }
                            }
                          },
                          "span": {
                            "start": 114,
                            "end": 131
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 114,
                          "end": 134
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 155,
                            "end": 157
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "iterable"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 136,
                                "end": 154
                              }
                            }
                          },
                          "span": {
                            "start": 136,
                            "end": 154
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 136,
                          "end": 157
                        }
                      }
                    ],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 103,
                  "end": 161
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 87,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
