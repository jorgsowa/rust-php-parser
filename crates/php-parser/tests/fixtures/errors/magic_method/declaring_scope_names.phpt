===description===
Magic method errors name the declaring interface, trait, enum, namespaced class or anonymous class.
===source===
<?php
namespace N;
interface I { function __toString(): int; }
trait T { function __get() {} }
class C { function __call($n, int $a) {} }
$x = new class { function __set(int $n, $v) {} };
enum E { function __call($a) {} }
===errors <=8.0===
N\I::__toString(): Return type must be string when declared
Method N\T::__get() must take exactly 1 argument
N\C::__call(): Parameter #2 ($a) must be of type array when declared
class@anonymous::__set(): Parameter #1 ($n) must be of type string when declared
'enums' requires PHP 8.1 or higher
Method N\E::__call() must take exactly 2 arguments
===errors >=8.1===
N\I::__toString(): Return type must be string when declared
Method N\T::__get() must take exactly 1 argument
N\C::__call(): Parameter #2 ($a) must be of type array when declared
class@anonymous::__set(): Parameter #1 ($n) must be of type string when declared
Method N\E::__call() must take exactly 2 arguments
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 7
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 7
===php_error >=8.1===
PHP Fatal error:  N\I::__toString(): Return type must be string when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 42,
                      "end": 52
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 62
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 69,
              "end": 70
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 82,
                      "end": 87
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 63,
        "end": 94
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 101,
              "end": 102
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
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 114,
                      "end": 120
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 121,
                          "end": 123
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 121,
                        "end": 123
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 129,
                          "end": 131
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 125,
                              "end": 128
                            }
                          }
                        },
                        "span": {
                          "start": 125,
                          "end": 128
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 125,
                        "end": 131
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 105,
                "end": 135
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 95,
        "end": 137
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 138,
                  "end": 140
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
                                "Method": {
                                  "name": {
                                    "name": "__set",
                                    "span": {
                                      "start": 164,
                                      "end": 169
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "n",
                                        "span": {
                                          "start": 174,
                                          "end": 176
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Named": {
                                            "parts": [
                                              "int"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 170,
                                              "end": 173
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 170,
                                          "end": 173
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 170,
                                        "end": 176
                                      }
                                    },
                                    {
                                      "name": {
                                        "name": "v",
                                        "span": {
                                          "start": 178,
                                          "end": 180
                                        }
                                      },
                                      "type_hint": null,
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 178,
                                        "end": 180
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 155,
                                "end": 184
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 143,
                        "end": 186
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 143,
                  "end": 186
                }
              }
            }
          },
          "span": {
            "start": 138,
            "end": 186
          }
        }
      },
      "span": {
        "start": 138,
        "end": 187
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 193,
              "end": 194
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 206,
                      "end": 212
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 213,
                          "end": 215
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 213,
                        "end": 215
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 197,
                "end": 219
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 188,
        "end": 221
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 221
  }
}
