===source===
<?php if { }
===errors===
expected '(', found '{'
expected expression
unclosed '')'' opened at Span { start: 9, end: 10 }
expected statement
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": "Error",
                  "span": {
                    "start": 9,
                    "end": 10
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 9,
              "end": 12
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 12,
              "end": 12
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
