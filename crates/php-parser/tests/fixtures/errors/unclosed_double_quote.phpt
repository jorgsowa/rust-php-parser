===source===
<?php "unclosed string
===errors===
expected ';' after expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "unclosed"
          },
          "span": {
            "start": 7,
            "end": 15
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "string"
          },
          "span": {
            "start": 16,
            "end": 22
          }
        }
      },
      "span": {
        "start": 16,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
