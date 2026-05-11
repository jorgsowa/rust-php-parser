===type===
(T is string ? non-empty-string : string)
===output===
{
  "kind": {
    "Conditional": {
      "subject": {
        "kind": {
          "Named": "T"
        },
        "span": {
          "start": 1,
          "end": 2
        }
      },
      "target": {
        "kind": {
          "Named": "string"
        },
        "span": {
          "start": 6,
          "end": 12
        }
      },
      "then_type": {
        "kind": {
          "Named": "non-empty-string"
        },
        "span": {
          "start": 15,
          "end": 31
        }
      },
      "else_type": {
        "kind": {
          "Named": "string"
        },
        "span": {
          "start": 34,
          "end": 40
        }
      }
    }
  },
  "span": {
    "start": 1,
    "end": 40
  }
}
