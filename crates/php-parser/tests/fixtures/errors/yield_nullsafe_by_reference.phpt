===source===
<?php
function &f($a) {
    yield $a?->b;
    yield 1 => $a?->b[0];
}
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.2===
Cannot take reference of a nullsafe chain
Cannot take reference of a nullsafe chain
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Cannot take reference of a nullsafe chain in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 18,
                "end": 20
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 34,
                                "end": 36
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "b"
                              },
                              "span": {
                                "start": 39,
                                "end": 40
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 40
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 41
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 52,
                          "end": 53
                        }
                      },
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "NullsafePropertyAccess": {
                                  "object": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 57,
                                      "end": 59
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "b"
                                    },
                                    "span": {
                                      "start": 62,
                                      "end": 63
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 57,
                                "end": 63
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 64,
                                "end": 65
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 57,
                          "end": 66
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 66
                  }
                }
              },
              "span": {
                "start": 46,
                "end": 67
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
