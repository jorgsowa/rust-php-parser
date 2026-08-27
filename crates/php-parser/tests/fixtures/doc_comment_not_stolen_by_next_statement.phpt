===description===
Regression test: a doc comment nested inside a statement's own parens/brackets
(here, above a closure argument in a function call) must not leak forward and
get attached to whichever statement is parsed next. Statements like this one
close without ever opening a `{`/`}` scope of their own, so the doc-comment
floor must also track the end of the last fully-parsed statement, not just
scope braces.
===source===
<?php
foo(/** @param T $x */ fn($x) => $x, $other);

bar();

/** legit doc comment */
baz();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ArrowFunction": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [
                          {
                            "name": "x",
                            "type_hint": null,
                            "default": null,
                            "by_ref": false,
                            "variadic": false,
                            "is_readonly": false,
                            "is_final": false,
                            "visibility": null,
                            "set_visibility": null,
                            "attributes": [],
                            "span": {
                              "start": 32,
                              "end": 34
                            }
                          }
                        ],
                        "return_type": null,
                        "body": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 39,
                            "end": 41
                          }
                        },
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 41
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 41
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "other"
                    },
                    "span": {
                      "start": 43,
                      "end": 49
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 43,
                    "end": 49
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 50
          }
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 53,
                  "end": 56
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 53,
            "end": 58
          }
        }
      },
      "span": {
        "start": 53,
        "end": 59
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "baz"
                },
                "span": {
                  "start": 86,
                  "end": 89
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 86,
            "end": 91
          }
        }
      },
      "span": {
        "start": 86,
        "end": 92
      },
      "doc_comment": {
        "kind": "Doc",
        "text": "/** legit doc comment */",
        "span": {
          "start": 61,
          "end": 85
        }
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
