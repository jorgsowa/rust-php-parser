===source===
<?php class A extends B { function f() { return [self::class::class, parent::class::class]; } }
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on string
Cannot use "::class" on string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM), expecting ']' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type string in Standard input code on line 1
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on string in Standard input code on line 1
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "ClassConstAccess": {
                                        "class": {
                                          "kind": {
                                            "ClassConstAccess": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "self"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 49,
                                                      "end": 53
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 49,
                                                  "end": 53
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "class"
                                                },
                                                "span": {
                                                  "start": 55,
                                                  "end": 60
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 49,
                                            "end": 60
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "class"
                                          },
                                          "span": {
                                            "start": 62,
                                            "end": 67
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 49,
                                      "end": 67
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 67
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "ClassConstAccess": {
                                        "class": {
                                          "kind": {
                                            "ClassConstAccess": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "parent"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 69,
                                                      "end": 75
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 69,
                                                  "end": 75
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "class"
                                                },
                                                "span": {
                                                  "start": 77,
                                                  "end": 82
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 69,
                                            "end": 82
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "class"
                                          },
                                          "span": {
                                            "start": 84,
                                            "end": 89
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 69,
                                      "end": 89
                                    }
                                  }
                                },
                                "span": {
                                  "start": 69,
                                  "end": 89
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 48,
                            "end": 90
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 91
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 93
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
